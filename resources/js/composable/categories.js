import axios from "axios";
import { ref } from "vue";

export default function useCategories() {
    const categories = ref([]);

    const getCategories = async () => {
        await axios.get("/api/categories")
        .then((response)=> {
            console.log(response)
            categories.value = response.data.data
        })
    }

    return {
        getCategories,
        categories
    }
}