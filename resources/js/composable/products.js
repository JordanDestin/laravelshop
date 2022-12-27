import axios from "axios";
import { ref, inject } from "vue";

export default function useProducts() {
    const products = ref({});
    const productstendance = ref({});
    const cartCount = ref(0);
    const totalcart = ref(0);
    const contents = ref([]);
    const toast = inject("toast");

    const getProducts = async (page = 1, category = "") => {
        await axios
            .get("/api/products?page=" + page + "&category=" + category)
            .then((response) => {
                products.value = response.data;
            });
    };

    const getProductTendance = async()=>{
        await axios
            .get("/api/product-tendance")
            .then((response)=>{
                productstendance.value = response.data.productsTendance
            })
    }

    const getCount = async () => {
        let response = await axios.get("/api/carts/count");
    };

    const cartContent = async () => {
        let response = await axios.get("/api/carts");
        contents.value = response.data.cartContent;
        totalcart.value = response.data.totalCart;
        cartCount.value = response.data.count;
    };

    const addProduct = async (id) => {
        let response = await axios.post("/api/carts", { id: id });

        cartCount.value = response.data.count;

        toast.success("Article bien Ajouté", {
            position: "top-right",
        });

        return response.data.count;
    };

    const increaseQuantity = async (id) => {
        let response = await axios.get("/api/carts/increase/" + id);
    };

    const decreaseQuantity = async (id) => {
        let response = await axios.get("/api/carts/decrease/" + id);
    };

    const destroyProduct = async (id) => {
        let response = await axios.delete("/api/carts/" + id);
    };

    return {
        getProducts,
        getProductTendance,
        products,
        productstendance,
        addProduct,
        getCount,
        cartContent,
        contents,
        increaseQuantity,
        decreaseQuantity,
        destroyProduct,
        cartCount,
        totalcart,
    };
}
