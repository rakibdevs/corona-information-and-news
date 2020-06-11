<template>
    <div class="row">
        <div class="col-sm-12">
            <DataTable
                :header-fields="headerFields"
                :data="collections"
            />
        </div>
    </div>
</template>

<script>
    import { DataTable } from 'v-datatable-light';
    const addZero = value => ("0" + value).slice(-2);

    const formatDate = value => {
      if (value) {
        const dt = new Date(value);
        return `${addZero(dt.getDate())}/${addZero(
          dt.getMonth() + 1
        )}/${dt.getFullYear()}`;
      }
      return "";
    };

    export default {
        props:['collections'],
        components: {
            DataTable
        },
        data(){
            return {
                headerFields: [
                    {
                      name: "name",
                      label: "Name",
                      sortable: true
                    },
                    {
                      name: "contact_no",
                      label: "Contact No",
                      sortable: false
                    },
                    {
                      name: "amount",
                      label: "Amount",
                      sortable: true
                    },
                    {
                      name: "created_at",
                      label: "date",
                      sortable: true,
                      format: formatDate
                    },
                    {
                      name: "updated_at",
                      label: "Updated",
                      sortable: false,
                      format: formatDate
                    },
                    "__slot:actions"
                ]
            }
        },
        methods:{
           /*filter(id){
                axios.post('/get-portfolios',{ id: id})
                .then(response => { 
                    this.portfolios  = response.data.projects;
                    this.activeClass = id;
                })
                .catch(error => this.setError(error));
            }*/
        },
        mounted() {
            /*axios.post('/get-portfolios')
           .then(response => { 
                this.portfolios = response.data.projects 
            })
           .catch(error => this.setError(error));*/
        }
    }
</script>
