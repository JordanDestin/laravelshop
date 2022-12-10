import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";

const user = reactive({
    name: "",
    email: "",
});

export default function useAuthBack() {
    const processing = ref(false);
    const validationErrors = ref({});
    const router = useRouter();
    const loginFormBack = reactive({
        email: "",
        password: "",

    });

    const submitLoginBack = async () => {
        if (processing.value) return;

        processing.value = true;
        validationErrors.value = {};

        await axios
            .post("/login-back", loginFormBack)
            .then(async (response) => {
                loginUserBack(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (processing.value = false));
    };

    const logoutBack = async () => {
       
        axios
            .post("/logout ")
            .then((response) => {
                localStorage.removeItem("loggedInBack");
                router.push("/login-back");
            })
            .catch((error) => {
                console.log(error);
            })

    };


    const loginUserBack = (response) => {
        user.name = response.data.name;
        user.email = response.data.email;
        localStorage.setItem("loggedInBack", JSON.stringify(true));
        router.push("/dashboard");
    };

    return {
        loginFormBack,
        submitLoginBack,
        processing,
        validationErrors,
        logoutBack
    }
}