export default {
    modify(user, model) {
        return user.id === model.user_id;
    },
    accept(user, model) {
        return user.id === model.user_id;
    },
    delete(user, model) {
        return user.id === model.user_id;
    },
    delete_ques(user, model) {
        return user.id === model.user_id && model.questions_count < 1;
    }
};
