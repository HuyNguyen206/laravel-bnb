export default {
    methods:{
        errorFor(errors, field)
        {
            return errors != null && errors[field] ? errors[field] : null
        }
    },
    data(){
        return {
            loading: false,
            errors:[]
        }
    }
}
