<template>
    <nav aria-label="Page navigation example" v-if="links.length > 3">
        <ul class="pagination">
            <template v-for="(link, k) in links" :key="k">
                <li v-if="link.url === null" class="page-item page-link" v-html="link.label"></li>
                <li v-else class="page-item" :class="{ active: link.active }"><Link preserve-state class="page-item page-link" :href="link.url" v-html="link.label" preserve-scroll/></li>
            </template>
        </ul>
    </nav>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {

    components:{
        Link
    },

    props: {
        links: Array,
    },
}
</script>
