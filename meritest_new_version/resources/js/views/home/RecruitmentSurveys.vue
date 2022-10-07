<template>
    <div>
        <base-dialog :title="'Recruitment & Surveys'" @close="$emit('close')">
            <template #default>
                <div>
                    <p><strong>Recruitment/Career :</strong> Recruitment/Job Alert Website Builder</p>
                    <router-link to="/contact-us">Contact Us</router-link>
                    <p>We will provide Bootstrap <strong>Recruitment/Job alerts generator / creator / builder</strong></p>
                    <p><strong>Follow these simple steps to create your own Recruitment &amp; Career website:</strong></p>
                    <div>
                        <ul>
                            <li><p>1. Mention your website name</p>
                                <p>Select a name for your Recruitment website that can help your business stand out.</p></li>
                            <li><p>2. Add preferred features to your website</p>
                                <p>Create a great Recruitment &amp; Career website without any coding</p></li>
                            <li><p>3. Publish your website</p>
                                <p>Test your Recruitment &amp; Career website and launch it</p></li>
                            
                        </ul>
                    </div>
                    <p><strong>Surveys:</strong> Create and distribute surveys and collect instant feedback anytime, anywhere with MERITEST free survey maker tool.
Collect and organize information big and small with Survey Tool
Our online survey builder includes reporting functionality that allows you to:</p>
                    <div>
                        <ul>
                            <li>Visualize your data in easy-to-read charts</li>
                            <li>Create your own reports with a wide range of visuals to choose from</li>
                            <li>Choose your format, from PDF and word document to web pages</li>
                            <li>See different demographics or data cuts side-by-side</li>
                            <li>Share reports quickly and easily with others in the organization</li>
                        </ul>
                    </div>
                    <p>Our survey tool also gives the ability to build reports using filters and breakouts. This is useful if you want to cut the data for different stakeholders in the business — you simply create your report, choose your breakouts and the software automatically creates the different reports you need.</p>
                </div>
            </template>
        </base-dialog>
        
    </div>
</template>

<script>
import BaseDialog from '../../UI/BaseDialog.vue'

export default {
    components: {
        BaseDialog,
    },
    emits: ['close']
}
</script>
