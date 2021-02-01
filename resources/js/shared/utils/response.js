export const is404 = ((err) => {
    return errWithResStatus(err) &&
        404 === err.response.status
});

export const is422 = ((err) => {
    return errWithResStatus(err) &&
        422 === err.response.status
});

const errWithResStatus = (err => {
    return  err.response &&
        err.response.status
})
