import axios from "axios";
import emitter from "tiny-emitter/instance";
import { ref, inject } from "vue";

export default function useCart() {
    const carCount = ref(0);
    const totalcart = ref(0);
    const contents = ref([]);
    const toast = inject("toast");

    const cartContent = async () => {
       await axios.get("/api/carts").then((response) => {
            contents.value = response.data.cartContent;
            
            totalcart.value = response.data.totalCart;
            
            carCount.value = response.data.count;

            console.log(carCount.value,'carCount value')
        })
        .catch((err) => console.log(err));
    };

    const addProductCart = async (id) => {
       await axios.post("/api/carts", { id: id }).then((response) => {
            carCount.value = response.data.count;
            emitter.emit("cartCount", carCount.value);
            toast.success("Article bien Ajouté", {
                position: "top-right",
            });
            console.log(carCount.value);
        })
        .catch((err) => console.log(err));
    };

    const increaseQuantity = async(id) =>{
       await axios.get("/api/carts/increase/"+id);
       cartContent();
    };

    const decreaseQuantity = async(id) =>{
        await axios.get("/api/carts/decrease/"+id);
        cartContent();
    };

    const destroyProduct = async(id) =>{
        await axios.delete("/api/carts/"+id);
        cartContent();
    };

    return {
        addProductCart,
        cartContent,
        contents,
        totalcart,
        carCount,
        increaseQuantity,
        decreaseQuantity,
        destroyProduct
    };
}
