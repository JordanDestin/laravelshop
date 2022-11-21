import axios from "axios";
import { ref, reactive } from "vue";

export default function useProfil() {
    const processing = ref(false);
    const validationErrors = ref({});
    const addresses = ref([])
    const addressForm = reactive({
        address:"",
        addressbis:"",
        postal:"",
        city:""
    });

    const getAddress = async()=>{

        console.log('qsdqsd')
        await axios.get("/api/adresses").then((response) => {
            addresses.value = response.data.data;
            console.log(addresses.value);
          });

  
    }

    const submitAddress = async()=>{
        if (processing.value) return;
        processing.value = true;
        validationErrors.value = {};
        
        await axios
        .post("/api/adresses", addressForm)
        .then((response) => {
            console.log(response)
            addresses.value = response.data
        })
        .catch((error) => {
            if (error.response?.data) {
                validationErrors.value = error.response.data.errors;
            }
        })

    }

    return {
        addressForm,
        submitAddress,
        validationErrors,
        getAddress,
        addresses
    }
}