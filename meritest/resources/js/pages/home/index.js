import EducationalInstitutions from './EducationalInstitutions.vue';
import CoachingClasses from './CoachingClasses.vue';
import CollageUniversities from './CollageUniversities.vue';
import DistanceEducation from './DistanceEducation.vue';
import ITSolutions from './ITSolutions.vue';
import RecruitmentSurveys from './RecruitmentSurveys.vue';
import SchoolsOlympiads from './SchoolsOlympiads.vue';
import TrainingCertificate from './TrainingCertificate.vue';
import BuildForTeachers from './BuildForTeachers.vue';
import BuildForStudents from './BuildForStudents.vue';
import BuildForParents from './BuildForParents.vue';

export default home => {
    home.components(EducationalInstitutions);
    home.components(CoachingClasses);
    home.components(CollageUniversities);
    home.components(DistanceEducation);
    home.components(ITSolutions);
    home.components(RecruitmentSurveys);
    home.components(SchoolsOlympiads);
    home.components(TrainingCertificate);
    home.components(BuildForTeachers);
    home.components(BuildForStudents);
    home.components(BuildForParents);
}