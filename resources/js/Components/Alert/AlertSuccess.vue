<template>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                {{ $page.props.flash.message }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AlertSuccess"
}
</script>
