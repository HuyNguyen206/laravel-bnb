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
        addToBasket(state, payload){
            state.basket.items.push(payload)
        },
        removeFromBasket(state, id)
        {
            state.basket.items =  state.basket.items.filter((item) => {
                return item.bookable.id != id
            })
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
