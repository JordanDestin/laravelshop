import axios from "axios";
import emitter from "tiny-emitter/instance";
import { ref, inject } from "vue";

export default function useCart() {
    const carCount = ref(0);
    const totalcart = ref(0);
    const contents = ref([]);
    const toast = inject("toast");

    const cartContent = async () => {
        axios.get("/api/carts").then((response) => {
            contents.value = response.data.cartContent;
            console.log(contents.value,'content value')
            totalcart.value = response.data.totalCart;
            carCount.value = response.data.count;
        })
        .catch((err) => console.log(err));
    };

    const addProductCart = async (id) => {
        axios.post("/api/carts", { id: id }).then((response) => {
            carCount.value = response.data.count;
            emitter.emit("cartCount", carCount.value);
            toast.success("Article bien Ajouté", {
                position: "top-right",
            });
            console.log(carCount.value);
        })
        .catch((err) => console.log(err));
    };

    return {
        addProductCart,
        cartContent,
        contents
    };
}
