export const isLogin = function(){
    return localStorage.getItem('isLogin')
}
export const login = function(){
    localStorage.setItem('isLogin', true)
}
export const logout = function(){
    localStorage.setItem('isLogin', false)
}
