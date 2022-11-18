import axios from "axios";
import { ref, inject } from "vue";
import { useRouter } from "vue-router";

export default function useProductsBack() {
    const router = useRouter();
    const products = ref({});
    const validationErrors = ref({});
    const isLoading = ref(false);

    const toast = inject("toast");

    const getAllProducts = async (page = 1, category = "") => {
        await axios
            .get("/api/admin-products?page=" + page + "&category=" + category)
            .then((response) => {
                console.log(response.data);
                router.push({ path: "list-product" });
                products.value = response.data;
            })
            
    };

    const addProduct = async (product) => {
        if(isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializeProduct = new FormData();
        for (let item in product) {
            if (product.hasOwnProperty(item)) {
                serializeProduct.append(item, product[item]);
            }
        }
        await axios
            .post("/api/admin-products", serializeProduct)
            .then((response) => {
                console.log(response.data);
                //  products.value = response.data.listproducts;
                products.value = response.data;
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(()=>isLoading.value = false);
    };

    const destroyProduct = async (id) => {};

    return {
        getAllProducts,
        products,
        addProduct,
        destroyProduct,
        validationErrors,
        isLoading
    };
}
