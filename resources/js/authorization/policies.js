export default {
    modify(user, model) {
        return user.id === model.user_id;
    },
    accept(user, model) {
        return user.id === model.user_id;
    }
};
