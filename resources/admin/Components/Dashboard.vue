<template>
    <div class="dashboard box_wrapper">
        <div class="box_header" style="padding: 35px;font-size: 16px;background: white;max-width: 600px;margin: 0 auto;">
            <div class="header-actions">
                <el-button type="primary" @click="navigateToCreateDoctor">Add Doctor</el-button>
                <el-input v-model="searchTerm" placeholder="Search by specialty" @input="fetchDoctors" clearable></el-input>
            </div>
            <el-table :data="doctors" style="width: 100%; margin-top: 20px;">
                <el-table-column prop="username" label="Username"></el-table-column>
                <el-table-column prop="email" label="Email"></el-table-column>
                <el-table-column prop="name" label="Name"></el-table-column>
                <el-table-column prop="speciality" label="Speciality"></el-table-column>
                <el-table-column prop="contact_info" label="Contact Info"></el-table-column>
                <el-table-column label="Actions">
                    <template v-slot="scope">
                        <el-button @click="managePatients(scope.row)">Patients</el-button>
                        <el-button @click="editDoctor(scope.row)">Edit</el-button>
                        <el-button type="danger" @click="deleteDoctor(scope.row.id)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            me: this.appVars.me,
            doctors: [],
            searchTerm: '',
            saving: false
        };
    },
    methods: {
        navigateToCreateDoctor() {
            this.$router.push({ name: 'create-doctor' });
        },
        fetchDoctors() {
            this.saving = true;
            this.$get('doctors', {
                search: this.searchTerm,
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
        editDoctor(doctor) {
            this.$router.push({ name: 'edit-doctor', params: { id: doctor.id } });
        },
        managePatients(doctor) {
            this.$router.push({ name: 'patient-management', params: { id: doctor.id } });
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

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header-actions .el-button {
    margin-right: 20px;
}
</style>
