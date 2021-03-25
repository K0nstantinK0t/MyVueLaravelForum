import axios from 'axios'

export function registrationNewUser(newUser) {
    return new Promise(function (resolve, reject) {
        axios.get('http://api.myforum/sanctum/csrf-cookie').then(response => {
            console.log(response)
            axios.post('http://api.myforum/api/register', newUser).then(response => {
                const token = response.data.token
                resolve(token)
            }).catch(error => {
                reject(error)
            })
        }).catch(error => {
            reject(error)
        })
    })
}
