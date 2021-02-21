import {login, logout, isLogin} from './shared/utils/auth'
export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket:{
            items:[]
        },
        isLogin:false,
        userState:{}
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload
        },
        setUser(state, payload) {
            state.userState = payload
        },
        setIsLogin(state, payload) {
            state.isLogin = payload
        },
        setBasket(state, payload) {
            state.basket.items = payload
        },
        addToBasket(state, payload){
            state.basket.items.push(payload)
        },
        removeFromBasket(state, id)
        {
            state.basket.items =  state.basket.items.filter((item) => {
                return item.bookable.id != id
            })
            localStorage.setItem('basket',  JSON.stringify(state.basket.items))
        }
    },
    actions:{
        setLastSearch(context, payload)
        {
            context.commit('setLastSearch', payload);
            localStorage.setItem('lastSearch', JSON.stringify(payload))
        },
        setBasket(context, payload)
        {
            context.commit('setBasket', payload)
            localStorage.setItem('basket',  JSON.stringify(payload))
        },
        // setUser(context, payload)
        // {
        //     context.commit('setUser', payload)
        //     localStorage.setItem('userState',  JSON.stringify(payload))
        // },
        setIsLogin(context, payload)
        {
            context.commit('setIsLogin', payload)
            login()
        },
        loadStoredSearch({commit})
        {
            let lastSearch = localStorage.getItem('lastSearch');
            if(lastSearch)
            {
                commit('setLastSearch',JSON.parse(lastSearch))
            }
            let basket = localStorage.getItem('basket');
            if(basket)
            {
                commit('setBasket',JSON.parse(basket))
            }

            // let user = localStorage.getItem('userState');
            // if(user)
            // {
            //     commit('setUser',JSON.parse(user))
            // }

            let isLogin = localStorage.getItem('isLogin');
            if(isLogin)
            {
                commit('setIsLogin',JSON.parse(isLogin))
            }
        },
        addToBasket({commit, state}, payload)
        {
            commit('addToBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket.items))
        },
       async loadUserInfo({dispatch, commit}){
            console.log(isLogin())
            if(isLogin())
            {
                try {
                    let userState = (await axios.get('/user')).data
                    commit('setUser', userState)
                    dispatch('setIsLogin', true)
                }
                catch (err)
                {
                    dispatch('logout')
                }
            }
        },
        logout({commit, dispatch})
        {
            commit('setUser', {})
            commit('setIsLogin', false)
            logout()
        }
    },
    getters:{
        itemsInBasket(state)
        {
            return state.basket.items.length
        },
        basket(state)
        {
            return state.basket
        },
        userState(state)
        {
            return state.userState
        },
        isLogin(state)
        {
            return state.isLogin
        }
    }
}
