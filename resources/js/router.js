import VueRouter from 'vue-router';
import SecondComponent from "./components/SecondComponent";
import BookablePage from "./Bookable/BookablePage";

const routes = [
    {
        path:'/',
        component: BookablePage,
        name: 'home',
    },
    {
        path:'/second',
        component: SecondComponent,
        name:'second'
    }
]
const router = new VueRouter({routes,   mode: 'history'})
export default router;
