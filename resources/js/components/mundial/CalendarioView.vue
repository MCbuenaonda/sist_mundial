<template>
    <div class="text-center section">
        <v-calendar :attributes="attributes" :from-date="new Date(parseInt(fromDate[0]), (parseInt(fromDate[1]) - 1), parseInt(fromDate[2]))" is-expanded is-dark/>
    </div>
</template>

<script>
export default {
    props: ['juegos'],
    data() {
        const todos = [];
        return {
            color: '',
            fromDate: [],
            listJuegos: JSON.parse(this.juegos),
            incId: todos.length,
            todos,
        };
    },
    mounted(){
        this.fromDate = this.listJuegos[0].fecha.split('-')

        this.listJuegos.forEach(element => {
            if (element.confederacion_id == 1) { this.color = 'blue' }
            if (element.confederacion_id == 2) { this.color = 'red' }
            if (element.confederacion_id == 3) { this.color = 'green' }
            if (element.confederacion_id == 4) { this.color = 'gray' }
            if (element.confederacion_id == 5) { this.color = 'pink' }
            if (element.confederacion_id == 6) { this.color = 'yellow' }
            if (element.confederacion_id == 7) { this.color = 'pink' }
            if (element.confederacion_id == 8) { this.color = 'purple' }


            const array_fec = element.fecha.split('-')
            const object = {
                description: element.paisL.nombre+'-'+element.paisV.nombre,
                isComplete: false,
                dates: [
                    new Date(parseInt(array_fec[0]), (parseInt(array_fec[1]) - 1), parseInt(array_fec[2])),
                ],
                color: this.color
            }

            this.todos.push(object)
        });

        console.log(this.todos);
    },
    computed: {
        attributes() {
            return [
                // Attributes for todos
                ...this.todos.map(todo => ({
                    dates: todo.dates,
                    dot: {
                        color: todo.color,
                        class: todo.isComplete ? 'opacity-75' : '',
                    },
                    popover: {
                        label: todo.description,
                    },
                    customData: todo,
                })),
            ];
        },
    },
};
</script>

<style>

</style>
