<template>
    <div>
    	<h2 class="sidebar-title">Attributes</h2>
    	<label for='i-name'>Name</label>
    	<input type="text" id='i-name'
            v-model="payload.name"
            @change="pluralize()"
        >
    	<h2 class="sidebar-title">Properties</h2>
        <div v-for= "(data, name) in keys" class="key">{{ name }}</div>
        <div v-for= "(data, name) in properties" class="prop">{{ name }}</div>
    	<!-- <label>This node has no properties</label> -->
    </div>
</template>

<script>
    export default {
        name: 'NodeProperies',

        data(){
            return {
                payload  : {
                	name: ''
                },
            };
        },

        mounted() {
            this.$root.$on('node-select', (data)=>{
                this.payload = data;
            });
        },

        computed: {

            keys: function(){
                if (_.size(this.payload.props) == 0 ) return {};
                return this.payload.props.keys;
            },

            properties: function(){
                if (_.size(this.payload.props) == 0 ) return {};
                return this.payload.props.strings;
            },

        },

        methods: {
            pluralize() {
                this.payload.name = _.deburr(global.constants.plural.plural(this.payload.name))
                this.payload.name = _.startCase(_.camelCase(this.payload.name));
                this.payload.name = this.payload.name.length === 0 ? 'Nodes' : this.payload.name;

                if ( this.payload.name === 'Migrations' ) this.payload.name = 'Transfers';
            }
        }

    }
</script>
