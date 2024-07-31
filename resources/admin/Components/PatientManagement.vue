<template>
    <div class="patient-management-container">
        <el-button type="primary" @click="navigateBack">Back to Doctor List</el-button>
        <el-card class="patient-management-card" shadow="hover">
            <div class="header">
            <h2>Manage Patients for Doctor {{ doctorId }}</h2>
        </div>
            <div class="actions">
           
                <el-button type="primary" @click="navigateToCreatePatient">Add Patient</el-button>
            <el-select v-model="healthConditionFilter" placeholder="Filter by Health Condition" @change="fetchPatients">
                <el-option label="All" value=""></el-option>
                <el-option label="Critical" value="critical"></el-option>
                <el-option label="Stable" value="stable"></el-option>
                <el-option label="Normal" value="normal"></el-option>

            </el-select>
            
        </div>
            <el-table :data="patients" style="width: 100%; margin-top: 20px;">
                <el-table-column prop="name" label="Name"></el-table-column>
                <el-table-column prop="email" label="Email"></el-table-column>
                <el-table-column prop="age" label="Age"></el-table-column>
                <el-table-column prop="gender" label="Gender"></el-table-column>
                <el-table-column prop="contact_info" label="Contact Info"></el-table-column>
                <el-table-column prop="health_condition" label="Health Condition"></el-table-column>
                <el-table-column label="Actions">
                    <template v-slot="scope">
                        <!-- <el-button @click="viewPatient(scope.row)">View</el-button> -->
                        <el-button @click="editPatient(scope.row)">Edit</el-button>
                        <el-button type="danger" @click="deletePatient(scope.row.id)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-card>
    </div>
</template>

<script>
export default {
    name: 'PatientManagement',
    data() {
        return {
            doctorId: this.$route.params.id,
            healthConditionFilter: '',
            patients: []
        };
    },
    methods: {
        navigateBack() {
            this.$router.push({ name: 'dashboard' });
        },
        navigateToCreatePatient() {
            this.$router.push({ name: 'create-patient', params: { id: this.doctorId } });
        },
        fetchPatients() {
            this.$get(`doctors/${this.doctorId}/patients`,{
                health_condition: this.healthConditionFilter,
            })
            .then(response => {
                this.patients = response.patients;
            })
            .catch(error => {
                this.$handleError(error);
                console.log(error);
            });
        },
    deletePatient(id){
        this.$del(`doctors/${this.doctorId}/patients/${id}`)
        .then(response => {
        this.$notify.success(response.message || 'Patient deleted successfully');
        this.fetchPatients();
    })
    .catch(error => {
        this.$handleError(error);
        console.log(error);
    });
    },
    editPatient(patient){
        this.$router.push({name: 'edit-patient', params: {doctorId: this.doctorId, patientId: patient.id}});
    }
},
    mounted() {
        this.fetchPatients();
    }
}
</script>

<style scoped>
.patient-management-container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.header {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 20px;
}

.patient-management-card {
    width: 100%;
    max-width: 800px;
    margin-top: 20px;
}
/* .header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
} */
.actions {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 800px;
    align-items: center;
}
.actions .filter-select {
    flex: 0 1 auto; /* Adjust width based on content */
    margin-left: auto;
}
</style>
