import VueRouter from 'vue-router';
import Bookable from "./Bookable/Bookable";
import BookablePage from "./Bookables/BookablePage";

const routes = [
    {
        path:'/',
        component: BookablePage,
        name: 'home',
    },
    {
        path:'/bookable/:id',
        component: Bookable,
        name:'bookable'
    }
]
const router = new VueRouter({routes,   mode: 'history'})
export default router;
