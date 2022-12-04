import axios from "axios";
import { ref,inject } from "vue";

export default function useProducts() {
    const products = ref({});
    const cartCount = ref(0);
    const totalcart = ref(0);
    const contents = ref([]);
    const toast = inject('toast');

    const getProducts = async (page=1,category='' ) => {
        await axios.get("api/products?page="+page+'&category='+category)
        .then((response) => {
            products.value = response.data;
        });
    };

    const getCount = async() => {
        let response = await axios.get("/api/carts/count");
       // cartCount.value = response.data.count
        console.log(response,"coucou")
        
    }

    const cartContent = async()=> {
        let response = await axios.get("/api/carts");
        contents.value = response.data.cartContent;
        totalcart.value = response.data.totalCart;
        cartCount.value = response.data.count
        console.log(totalcart.value,"totaux")
    };

    const addProduct = async (id) => {

        let response = await axios.post("/api/carts", { id: id });
        
        cartCount.value = response.data.count;

        toast.success("Article bien Ajouté", {
            position:"top-right"
        });
        console.log(cartCount.value,"addcart")
        return response.data.count;
    };

    const increaseQuantity = async(id) =>{
        let response = await axios.get("/api/carts/increase/"+id);
    };

    const decreaseQuantity = async(id) =>{
        let response = await axios.get("/api/carts/decrease/"+id);
    };

    const destroyProduct = async(id) =>{
        let response = await axios.delete("/api/carts/"+id);
    };





    return { 
        getProducts, 
        products, 
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
