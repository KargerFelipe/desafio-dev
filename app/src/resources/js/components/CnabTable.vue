<template>
    <div>
        <b-table
            striped
            hover
            dark
            :fields="fields"
            :items="operacoes">

            <template #cell(operacoes)="data">
                <b-table
                    striped
                    hover
                    dark
                    :items="data.item.operacoes">
                </b-table>
            </template>

        </b-table>
    </div>
</template>

<script>
export default {
    data(){
        return {
            fields: [
                { key: 'nomeLoja', label: 'Loja' },
                { key: 'proprietario', label: 'Proprietário' },
                { key: 'operacoes', label: 'Operações' },
                { key: 'total', label: 'Total' },
            ],
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

        self.$root.$on(
            'cnabImportado', () => {
                self.listaOperacoes()
            }
        )
    }
}
</script>
