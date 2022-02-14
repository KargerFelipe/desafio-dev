<template>
    <div>
        <b-table
            striped
            hover
            dark
            :items="operacoes">
        </b-table>
    </div>
</template>

<script>
export default {
    data(){
        return {
            operacoes: []
        }
    },
    methods: {
        listaOperacoes(){
            const self = this
            axios.get('/operacoes')
                .then(({data}) => {
                    self.operacoes = data
                })
                .catch((error) => {
                    console.error(error)
                })
        }
    },
    mounted(){
        const self = this
        self.listaOperacoes()
    }
}
</script>
