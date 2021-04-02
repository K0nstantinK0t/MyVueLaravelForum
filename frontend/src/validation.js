export function validateRegistrationData(data)
{
    let errors = []
    if(!data.name){
        errors.push('Имя не должно быть пустым')
    }
    if(!data.email){
        errors.push('Email не должен быть пустым')
    }
    if(!data.password){
        errors.push('Пароль не должен быть пустым')
    }
    if(data.password.length < 8)
        errors.push('Минимальная длина пароля 8 символов!')
    return errors
}

export function validateAuthData(data)
{
    let errors = []
    if(!data.email){
        errors.push('Email не должен быть пустым')
    }
    if(!data.password){
        errors.push('Пароль не должен быть пустым')
    }
    return errors
}