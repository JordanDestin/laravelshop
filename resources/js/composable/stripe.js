import { ref } from "vue";
import { registerOrder } from "../helper/index";
import { useRouter } from "vue-router";

//import { registerOrder } from "../../helpers";

export default function useStripe() {
    const router = useRouter();
    const elements = ref(null);
    const clientSecret = ref(null);
    const paymentElement = ref(null);
    const stripe = ref(null);

    const getClientSecret = async (addressId) => {
        stripe.value = Stripe(import.meta.env.VITE_STRIPE_TEST_PUBLIC_KEY);

        let secret = await axios
            .post("/api/paymentIntent/"+ addressId, {
                headers: { "Content-Type": "application/json" },
                // params : {id:addressId}

            })
            .then((response) => response.data.clientSecret)
            .catch((error) => console.log(error, "erreur stripe"));

        clientSecret.value = secret;
    };

    const loadStripeElements = async () => {
        elements.value = stripe.value.elements({
            clientSecret: clientSecret.value,
        });

        paymentElement.value = elements.value.create("payment");
        paymentElement.value.mount("#payment-element");
    };

    const handleSubmit = async () => {
        setLoading(true);

        const { error } = await stripe.value.confirmPayment({
            elements: elements.value,
            confirmParams: {
                return_url: import.meta.env.VITE_APP_URL + "/thank-you",
            },
        });

        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occured.");
        }

        setLoading(false);
    };

    const checkStatus = async () => {
        const clientSecret = new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret"
        );

        if (!clientSecret) {
            return;
        }

        const { paymentIntent } = await stripe.value.retrievePaymentIntent(
            clientSecret
        );

        switch (paymentIntent.status) {
            case "succeeded":
                console.log("paye");
                showMessage("Payment succeeded!");
         
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage(
                    "Your payment was not successful, please try again."
                );
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    };

    /**
     * UI Helpers
     */
    const showMessage = (messageText) => {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function () {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 4000);
    };

    const setLoading = (isLoading) => {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    };

    return {
        clientSecret,
        loadStripeElements,
        handleSubmit,
        getClientSecret,
        checkStatus,
    };
}
