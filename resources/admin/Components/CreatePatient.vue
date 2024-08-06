<template>
    <div class="create-patient-container">
        <el-button type="primary" @click="navigateBack">Back to Patient List</el-button>
        <el-card class="create-patient-card" shadow="hover">
            <h2>{{ isEdit ? 'Edit Patient' : 'Create Patient' }}</h2>
            <el-form :model="patients" label-width="120px" class="create-patient-form">
                <el-form-item label="Name">
                    <el-input v-model="patients.name"></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="patients.email"></el-input>
                </el-form-item>
                <el-form-item label="Age">
                    <el-input type="number" v-model="patients.age"></el-input>
                </el-form-item>
                <el-form-item label="Gender">
                    <el-select v-model="patients.gender" placeholder="Select Gender">
                        <el-option label="Male" value="male"></el-option>
                        <el-option label="Female" value="female"></el-option>
                        <el-option label="Other" value="other"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Contact Info">
                    <el-input v-model="patients.contact_info"></el-input>
                </el-form-item>
                <el-form-item label="Health Condition">
                    <el-select v-model="patients.health_condition" placeholder="Select Health Condition">
                        <el-option label="Critical" value="critical"></el-option>
                        <el-option label="Stable" value="stable"></el-option>
                        <el-option label="Normal" value="normal"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item class="form-actions">
                    <el-button type="primary" @click="savePatient">{{ isEdit ? 'Update' : 'Create' }}</el-button>
                    <el-button @click="navigateBack">Cancel</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
export default {
    name: 'CreatePatient',
    data() {
        return {
            doctorId: this.$route.params.id,
            patientId: this.$route.params.patientId,
            patients: {
                name: '',
                email: '',
                age: '',
                gender: '',
                contact_info: '',
                health_condition: ''
            },
            isEdit: false,
            saving: false
        };
    },
    methods: {
        navigateBack() {
            this.$router.push({ name: 'patient-management', params: { id: this.doctorId } });
        },
        fetchPatient(id) {
            this.saving = true;
            this.$get(`doctors/${this.doctorId}/patients/${id}`)
            .then(response => {
                this.patients = response;
            })
            .catch(errors => {
                this.$handleError(errors);
                console.log(errors);
            })
            .finally(() => {
                this.saving = false;
            });
        },
        savePatient() {
            this.saving = true;
            if (this.isEdit) {
                this.$put(`doctors/${this.doctorId}/patients/${this.patientId}`, this.patients)
                .then(response => {
                    console.log('API response:', response);
                    this.$notify.success(response.message || 'Patient edited successfully');
                    this.navigateBack();
                })
                .catch(errors => {
                    this.$handleError(errors);
                    console.log(errors);
                })
                .finally(() => {
                    this.saving = false;
                });
            } else {
                this.$post(`doctors/${this.doctorId}/patients`, {
                patients:this.patients,
            })
                .then(response => {
                    this.$notify.success(response.message || 'Patient created successfully');
                    this.navigateBack();
                })
                .catch(errors => {
                    this.$handleError(errors);
                    console.log(errors);
                })
                .finally(() => {
                    this.saving = false;
                });
            }
        }
    },
    mounted() {
        if (this.patientId) {
            this.isEdit = true;
            this.fetchPatient(this.patientId);
        }
    }
}
</script>

<style scoped>
.create-patient-container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.create-patient-card {
    width: 100%;
    max-width: 600px;
    margin-top: 20px;
}

.create-patient-form {
    width: 100%;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
</style>
