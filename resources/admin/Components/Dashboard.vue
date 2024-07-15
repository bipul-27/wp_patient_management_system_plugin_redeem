<template>
    <div class="dashboard box_wrapper">
        <div class="box_header" style="padding: 35px;font-size: 16px;background: white;max-width: 600px;margin: 0 auto;">
            <div>
                <el-button type="primary" @click="navigateToCreateDoctor">Add Doctor</el-button>
                <el-table :data="doctors" style="width: 100%">
                    <el-table-column prop="username" label="Username"></el-table-column>
                    <el-table-column prop="email" label="Email"></el-table-column>
                    <el-table-column prop="name" label="Name"></el-table-column>
                    <el-table-column prop="specialty" label="Specialty"></el-table-column>
                    <el-table-column prop="contact_info" label="Contact Info"></el-table-column>
                    <el-table-column label="Actions">
                        <template v-slot="scope">
                            <el-button @click="editDoctor(scope.row)">Edit</el-button>
                            <el-button type="danger" @click="deleteDoctor(scope.row.id)">Delete</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            me: this.appVars.me,
            doctors: [],  // Add the doctors property here
            saving: false
        };
    },
    methods: {
        navigateToCreateDoctor() {
            this.$router.push({ name: 'create-doctor' });
        },
        fetchDoctors() {
            this.saving = true;
            this.$get('doctors',{
                search: '',
            })
            .then(response => {
                this.doctors = response.doctors;

            })
            .catch(errors => {
                    this.$handleError(errors);
                    console.log(errors);
                })
             .finally(() => {
                 this.saving = false;
            });
            
        },
            
            
            // this.doctors = [
            //     { id: 1, username: 'doctor1', email: 'doctor1@example.com', name: 'Doctor One', specialty: 'Cardiology', contact_info: '123-456-7890' },
            //     { id: 2, username: 'doctor2', email: 'doctor2@example.com', name: 'Doctor Two', specialty: 'Dermatology', contact_info: '123-456-7891' }
            // ];
        
        editDoctor(doctor) {
            // Implement edit functionality
        },
        deleteDoctor(id) {
    this.$del(`doctors/${id}`)
    .then(response => {
        this.$notify.success(response.message || 'Doctor deleted successfully');
        this.fetchDoctors();
    })
    .catch(error => {
        this.$handleError(error);
        console.log(error);
    });
}
    },
    mounted() {
        this.fetchDoctors();
    }
};
</script>

<style scoped>
.dashboard {
    padding: 20px;
}

.box_header {
    padding: 20px;
    background: white;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
</style>
