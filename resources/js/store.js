export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket:{
            items:[]
        }
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload
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
        },
        addToBasket({commit, state}, payload)
        {
            commit('addToBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket.items))
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
        }
    }
}
