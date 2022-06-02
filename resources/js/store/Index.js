import { createStore } from "vuex";

const store = createStore({

    state: {
        patient: [],
        procedure: [],
        attention: [],
        payments: [],
    },

    mutations: {
        SET_PATIENT(state, payload) {
            state.patient = payload;
        },
        SET_PROCEDURE(state, payload) {
            state.procedure = payload;
        },
        SET_ATTENTION(state, payload) {
            state.attention = payload;
        },
        SET_PAYMENTS(state, payload) {
            state.payments = payload;
        },
    },

    getters: {
        getPatient(state) {
            return state.patient;
        },
        getAppointments(state) {
            return state.patient.appointments;
        },
        getProcedure(state) {
            return state.procedure;
        },
        getAttentions(state) {
            return state.patient.attentions;
        },
        getAttention(state) {
            return state.attention;
        },
        getPayments(state) {
            return state.payments;
        },

    },

})

export default store;
