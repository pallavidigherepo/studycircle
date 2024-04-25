import { useRouter } from 'vue-router'
import axiosClient from "@/axios";

const routerR = useRouter();

window.Laravel = {
    csrfToken: "{{ csrf_token() }}",
    user_permissions: await permission()
}

const permission = async function getAuth()
{
    console.log(routerR);
    if (router.currentRoute === "Login") {

    }
    return await axiosClient
        .get('/permissions')
        .then(({data}) => {
            return data;
        });
}

export default permission();
