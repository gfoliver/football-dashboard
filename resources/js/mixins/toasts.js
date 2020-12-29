export default {
    methods: {
        addToast({ title, text, variant }) {
            this.$bvToast.toast(text, {
                title,
                variant,
                solid: true
            });
        },
        addToastSuccess(text) {
            this.addToast({
                title: 'Success!', 
                text, 
                variant: 'success'
            });
        },
        addToastError(error, message = null) {            
            if (error.response)
                error = error.response;

            if (error.data)
                error = error.data;

            if (error.errors) {
                
                for (const err of Object.values(error.errors)) {
                    this.addToast({
                        title: 'Error!',
                        text: err,
                        variant: 'danger'
                    });
                }
            }
            else {
                if (error.message) {
                    this.addToast({
                        title: 'Error!',
                        text: error.message,
                        variant: 'danger'
                    });
                }
                else {
                    this.addToast({
                        title: 'Error!',
                        text: message ? message : 'Unexpected error.',
                        variant: 'danger'
                    });
                }
            }
        }
    }
}