const loginUrl = process.env.NODE_ENV === 'production' ? '/authentication_token' : 'http://localhost:8000/authentication_token';

const gravatar = 'data:image/png;base64,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';

const authProvider = {
    // authentication
    login: ({ username, password }) =>  {
        const request = new Request(loginUrl, {
            method: 'POST',
            body: JSON.stringify({ email: username, password }),
            headers: new Headers({ 'Content-Type': 'application/json' }),
        });
        return fetch(request)
            .then(response => {
                if (response.status < 200 || response.status >= 300) {
                    throw new Error(response.statusText);
                }
                return response.json();
            })
            .then(auth => {
                localStorage.setItem('auth', JSON.stringify(auth));
            })
            .catch(() => {
                throw new Error('Network error')
            });
    },
    checkError: (error) => {
        const status = error.status;
        if (status === 401 || status === 403) {
            localStorage.removeItem('auth');
            return Promise.reject();
        }
        // other error code (404, 500, etc): no need to log out
        return Promise.resolve();
    },
    checkAuth: () => localStorage.getItem('auth')
        ? Promise.resolve()
        : Promise.reject(),
    logout: () => {
            localStorage.removeItem('auth');
            return Promise.resolve();
        },
    getIdentity: () => localStorage.getItem('auth')
        ? Promise.resolve({ id: 1, fullName: 'admin', avatar: gravatar })
        : Promise.reject(),
    // authorization
    getPermissions: params => Promise.resolve(),
};

export default authProvider;
