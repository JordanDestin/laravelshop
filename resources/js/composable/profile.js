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
        await axios
        .get("api/adrress")
        .then((response) => {
            console.log(response.data)
            addresses.value = response.data
        })
    }

    const submitAddress = async()=>{
        if (processing.value) return;
        processing.value = true;
        validationErrors.value = {};
        
        await axios
        .post("/api/address", addressForm)
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