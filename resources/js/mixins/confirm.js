export default {
    methods: {
        confirm({ title, okTitle = "OK", okVariant = "primary" }) {
            return this.$bvModal.msgBoxConfirm(title, {
                headerBgVariant: 'dark',
                footerBgVariant: 'dark',
                bodyBgVariant: 'dark',
                okVariant: okVariant,
                okTitle: okTitle
            })
        }
    }
}