import VueRouter from 'vue-router';
import Bookable from "./Bookable/Bookable";
import BookablePage from "./Bookables/BookablePage";
import Review from "./Review/Review";
import Basket from  "./basket/basket"

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
    },
    {
        path: '/review/:id',
        component: Review,
        name:'review'
    },
    {
        path: '/basket',
        component: Basket,
        name:'basket'
    }
]
const router = new VueRouter({routes,   mode: 'history'})
export default router;
