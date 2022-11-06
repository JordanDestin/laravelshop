import axios from "axios";
import { ref,reactive } from "vue";
import { useRouter } from "vue-router";

export default function useAuth() {
    const processing = ref(false)
    const validationErrors = ref({})
    const router = useRouter();
    const loginForm = reactive ({
        email:'',
        password:'',
        remember:false
    })

    const registerForm = reactive ({
        name:'',
        email:'',
        password:'',
    })

    const submitRegister = async () => {
        await axios.get("/register").then((response) => {
            loginUser(response);
        });
    };

    const submitLogin = async () => {
        if (processing.value) return

        processing.value = true
        validationErrors.value = {}

        axios.post('/login', loginForm)
            .then(async response => {
                loginUser(response)
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => processing.value = false)
    };

    const loginUser = (response)=> {
        localStorage.setItem('loggedIn',JSON.stringify(true))
        router.push('/');
    }
   
    return { 
        loginForm,
        validationErrors,
        processing,
        submitLogin,
        registerForm
    };
}
