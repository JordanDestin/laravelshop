import axios from "axios";
import { ref,inject } from "vue";

export default function useProductsBack() {
    const products = ref({});
 
    const toast = inject('toast');

    const getAllProducts = async (page=1,category='') => {
        await axios.get("/api/list-product?page="+page+'&category='+category)
        .then((response) => {
            console.log(response.data)
          //  products.value = response.data.listproducts;
            products.value = response.data;
        });
    };

   


    const addProduct = async (id) => {

       
    };



    const destroyProduct = async(id) =>{
        
    };





    return { 
        getAllProducts, 
        products, 
        addProduct,   
        destroyProduct,
    };
}
