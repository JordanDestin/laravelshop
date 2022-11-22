import axios from "axios";
import { ref, inject } from "vue";
import { useRouter } from "vue-router";

export default function useProductsBack() {
    const router = useRouter();
    const products = ref({});
    const product = ref({});
    const validationErrors = ref({});
    const isLoading = ref(false);

    const toast = inject("toast");

    const getAllProducts = async (page = 1, category = "") => {
        await axios
            .get("/api/admin-products?page=" + page + "&category=" + category)
            .then((response) => {
                console.log(response.data);
                //router.push({ path: "list-product" });
                products.value = response.data;
            });
    };

    const getProduct = async (id) => {
        await axios.get("/api/product/" + id).then((response) => {
            console.log(response.data.data);
            product.value = response.data.data;
        });
    };

    const createProduct = async (product) => {
        if (isLoading.value) return;

        isLoading.value = true;
        validationErrors.value = {};

        let serializeProduct = new FormData();
        for (let item in product) {
            if (product.hasOwnProperty(item)) {
                serializeProduct.append(item, product[item]);
            }
        }
        await axios
            .post("/api/admin-products", serializeProduct)
            .then((response) => {
                products.value = response.data;
                router.push({ path: "list-product" });
                toast.success("Produit créer avec succès", {
                    position: "top-right",
                });
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (isLoading.value = false));
    };

    const updateProduct = async (product) => {
        if (isLoading.value) return;
        isLoading.value = true;
        validationErrors.value = {};

        let serializeProduct = new FormData();
        for (let item in product) {
            if (product.hasOwnProperty(item)) {
                console.log(item, "item");
                serializeProduct.append(item, product[item]);
            }
        }
        await axios
            .post("/api/product/" + product.id, serializeProduct)
            .then((response) => {
                products.value = response.data;
                router.push({ path: "list-product" });
                toast.success("Produit modifié", {
                    position: "top-right",
                });
            })
            .catch((error) => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors;
                }
            })
            .finally(() => (isLoading.value = false));
    };

    const deleteProduct = async (id) => {
        await axios
            .delete("/api/product/" + id)
            .then((response) => {
                router.push({ path: "list-product" });
                toast.success("Produit supprimé", {
                    position: "top-right",
                });
            })
            .catch((error) => {
                toast.error("Le produit n'a pas été supprimé", {
                    position: "top-right",
                });
            });
    };

    return {
        getAllProducts,
        getProduct,
        product,
        products,
        createProduct,
        deleteProduct,
        validationErrors,
        isLoading,
        updateProduct,
    };
}
