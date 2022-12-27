import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";

const user = reactive({
    name: "",
    email: "",
});

export default function useAuth() {
    const processing = ref(false);
    const validationErrors = ref({});
    const router = useRouter();
    const loginForm = reactive({
        email: "",
        password: "",
        remember: false,
    });

    const registerForm = reactive({
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
    });

    const submitRegister = async () => {
        if (processing.value) return;

        processing.value = true;
        validationErrors.value = {};
        await axios
            .post("register", registerForm)
            .then((response) => {
                loginUser(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (processing.value = false));
    };

    const submitLogin = async () => {
        if (processing.value) return;

        processing.value = true;
        validationErrors.value = {};

        await axios
            .post("/login", loginForm)
            .then(async (response) => {
                loginUser(response);
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (processing.value = false));
    };

    const loginUser = (response) => {
        user.name = response.data.name;
        user.email = response.data.email;
        localStorage.setItem("loggedIn", JSON.stringify(true));
        router.push("/");
    };

    const getUser = () => {
        axios.get("api/user").then((response) => {
            loginUser(response);
        });
    };

    const logout = async () => {
        if (processing.value) return;

        processing.value = true;
        console.log("qsdqsdqs");
        axios
            .post("logout")
            .then((response) => {
                localStorage.removeItem("loggedIn");
                router.push("/login");
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                processing.value = false;
            });
    };

    return {
        loginForm,
        validationErrors,
        processing,
        submitLogin,
        submitRegister,
        registerForm,
        logout,
        getUser,
        user,
    };
}
