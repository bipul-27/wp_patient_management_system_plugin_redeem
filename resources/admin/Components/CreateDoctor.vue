<template>
    <div class="create-doctor-container">
        <el-button type="primary" @click="navigateBack">Back to Doctor List</el-button>
        <el-card class="create-doctor-card" shadow="hover">
            <h2>Create Doctor</h2>
            <el-form :model="doctorForm" label-width="120px" class="create-doctor-form">
                <el-form-item label="Username">
                    <el-input v-model="doctorForm.username"></el-input>
                </el-form-item>
                <el-form-item label="Password">
                    <el-input type="password" v-model="doctorForm.password"></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="doctorForm.email"></el-input>
                </el-form-item>
                <el-form-item label="Name">
                    <el-input v-model="doctorForm.name"></el-input>
                </el-form-item>
                <el-form-item label="Specialty">
                    <el-input v-model="doctorForm.specialty"></el-input>
                </el-form-item>
                <el-form-item label="Contact Info">
                    <el-input v-model="doctorForm.contact_info"></el-input>
                </el-form-item>
                <el-form-item class="form-actions">
                    <el-button type="primary" @click="createDoctor">Create</el-button>
                    <el-button @click="navigateBack">Cancel</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
export default {
    data() {
        return {
            doctorForm: {
                username: '',
                password: '',
                email: '',
                name: '',
                specialty: '',
                contact_info: ''
            }
        };
    },
    methods: {
        navigateBack() {
            this.$router.push({ name: 'dashboard' });
        },
        createDoctor() {
            // Mocked create doctor function, replace with actual API call
            console.log('Creating doctor with data:', this.doctorForm);
            this.navigateBack();
        }
    }
}
</script>

<style scoped>
.create-doctor-container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.create-doctor-card {
    width: 100%;
    max-width: 600px;
    margin-top: 20px;
}

.create-doctor-form {
    width: 100%;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
</style>
