<template>
    <div class="patient-details-container">
        <el-button type="primary" @click="navigateBack">Back to Patient List</el-button>
        <el-card class="patient-details-card" shadow="hover">
            <h2>Patient Details</h2>
            <el-form :model="patient" label-width="120px" class="patient-details-form" disabled>
                <el-form-item label="Name">
                    <el-input v-model="patient.name" disabled></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="patient.email" disabled></el-input>
                </el-form-item>
                <el-form-item label="Age">
                    <el-input type="number" v-model="patient.age" disabled></el-input>
                </el-form-item>
                <el-form-item label="Gender">
                    <el-select v-model="patient.gender" disabled>
                        <el-option label="Male" value="male"></el-option>
                        <el-option label="Female" value="female"></el-option>
                        <el-option label="Other" value="other"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Contact Info">
                    <el-input v-model="patient.contact_info" disabled></el-input>
                </el-form-item>
                <el-form-item label="Health Condition">
                    <el-input v-model="patient.health_condition" disabled></el-input>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
export default {
    name: 'PatientDetails',
    data() {
        return {
            doctorId: this.$route.params.doctorId,
            patientId: this.$route.params.id,
            patient: {
                name: '',
                email: '',
                age: '',
                gender: '',
                contact_info: '',
                health_condition: ''
            }
        };
    },
    methods: {
        navigateBack() {
            this.$router.push({ name: 'patient-management', params: { id: this.doctorId } });
        },
        fetchPatient() {
            this.$get(`doctors/${this.doctorId}/patients/${this.patientId}`)
            .then(response => {
                this.patient = response;
            })
            .catch(error => {
                this.$handleError(error);
                console.log(error);
            });
        }
    },
    mounted() {
        this.fetchPatient();
    }
}
</script>

<style scoped>
.patient-details-container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.patient-details-card {
    width: 100%;
    max-width: 600px;
    margin-top: 20px;
}

.patient-details-form {
    width: 100%;
}
</style>
