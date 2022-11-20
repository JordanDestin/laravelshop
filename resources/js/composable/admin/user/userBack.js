import axios from "axios";
import { ref, inject } from "vue";
import { useRouter } from "vue-router";

export default function useUserBack() {
    const router = useRouter();
    const users = ref({});
    const orderUsers = ref({});

    const toast = inject("toast");

    const getAllUsers = async (page = 1, category = "") => {
        await axios.get("/api/list-user").then((response) => {
            console.log(response.data);
            //router.push({ path: "list-product" });
            users.value = response.data.data;
        });
    };

    const getOrdersUser = async(user)=>{
        await axios.get("/api/order-user/"+user).then((response) => {
            orderUsers.value = response.data.userOrders;
            console.log(orderUsers.value,'userorder');
          });
    }

    return {
        getAllUsers,
        users,
        getOrdersUser,
        orderUsers
    };
}
