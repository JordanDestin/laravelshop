import axios from "axios";
import { ref, reactive, inject } from "vue";
import { useRouter } from "vue-router";

export default function useProfil() {
    const router = useRouter();
    const processing = ref(false);
    const validationErrors = ref({});
    const toast = inject("toast");
    const addresses = ref([]);
    const address = ref([]);
    const addressForm = reactive({
        address: "",
        addressbis: "",
        postal: "",
        city: "",
    });

    const getAllAddress = async () => {

        await axios.get("/api/adresses").then((response) => {
            addresses.value = response.data.data;
            console.log(addresses.value);
        });
    };

    const createAddress = async () => {
        if (processing.value) return;
        processing.value = true;
        validationErrors.value = {};

        await axios
            .post("/api/adresses", addressForm)
            .then((response) => {
                console.log(response);
                addresses.value = response.data;
                router.push({ path: "list-address" });
                toast.success("Addresse ajouter avec succès", {
                    position: "top-right",
                });
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            });
    };

    const getAddress = async(id) =>{
       
        await axios.get("/api/adresses/" + id)
        .then((response) => {
            address.value = response.data.data
        })
    }

    const updateAddress = async(address)=>{
       console.log(address,'qsdqsddgrgrt')
        validationErrors.value = {};

        await axios
            .put("/api/adresses/"+address.id, address)
            .then((response) => {
                console.log(response);
                addresses.value = response.data;
                router.push({ path: "list-address" });
                toast.success("Addresse modifier avec succès", {
                    position: "top-right",
                });
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            });
    }

    const deleteAdress= async(id) =>{
        await axios
        .delete("/api/adresses/"+id)
        .then((response)=>{
            router.push({ path: "/profile" });
            toast.success("Addresse supprimer avec succès", {
                position: "top-right",
            });
        })
        .catch((error) => {
            toast.error("L'addresse n'a pas été supprimé", {
                position: "top-right",
            });
        });
    }

    return {
        getAllAddress,
        addresses,
        addressForm,
        createAddress,
        validationErrors,
        getAddress,
        address,
        updateAddress,
        deleteAdress
    };
}
