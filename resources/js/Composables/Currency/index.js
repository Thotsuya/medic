import { usePage } from "@inertiajs/inertia-vue3";
import {computed} from "vue";

export default function useCurrency() {

    const currencyLabel = computed(() => {
        return usePage().props.value.currency.currency
            ? `(${usePage().props.value.currency.currency})` : '';
    });

    return {
        currencyLabel
    }

}
