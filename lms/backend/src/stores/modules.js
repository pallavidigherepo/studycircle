import authModule from './modules/auth/index.js';
import permissionModule from './modules/permissions/index.js';
import roleModule from './modules/roles/index.js';
import userModule from './modules/users/index.js';
import coursesTypeModule from './modules/courses_types/index.js';
import coursesModule from './modules/courses/index.js';
import subjectModule from './modules/subjects/index.js';
import chapterModule from './modules/chapters/index.js';
import topicModule from './modules/topics/index.js';
import questionModule from './modules/questions/index.js';
import studentModule from './modules/students/index.js';
import templateModule from './modules/templates/index';
import generateQuestionModule from './modules/generate_questions/index';
import batchModule from './modules/batches/index';
import boardModule from './modules/boards/index.js';
import standardModule from './modules/standards/index.js';
import studentPaperModule from './modules/student_papers/index.js';
import inquiryModule from "./modules/inquiries/index.js";
import inquiryFollowupModule from "./modules/inquiry_followups/index.js";
import inquiryStatusModule from "./modules/inquiry_statuses/index.js";
import inquirySourcesModule from "./modules/inquiry_sources/index.js";
import inquiryFollowUpTypeModule from "./modules/inquiry_followup_types/index.js";
import parentModule from "./modules/parents/index.js";
import settingModule from "./modules/settings/index.js";
import feeTypeModule from "./modules/fee_types/index.js";
import feeCategoryModule from "./modules/fee_categories/index.js";
import feeDiscountModule from "./modules/fee_discounts/index.js";
import feeStructureModule from "./modules/fee_structures/index.js";
import feeModule from "./modules/fees/index.js";
import feeTransactionModule from "./modules/fee_transactions/index.js";

export default {
    auth: authModule,
    permissions: permissionModule,
    roles: roleModule,
    users: userModule,
    coursesTypes: coursesTypeModule,
    courses: coursesModule,
    subjects: subjectModule,
    chapters: chapterModule,
    topics: topicModule,
    questions: questionModule,
    students: studentModule,
    templates: templateModule,
    generated_questions: generateQuestionModule,
    batches: batchModule,
    boards: boardModule,
    standards: standardModule,
    inquiries: inquiryModule,
    inquiry_followups: inquiryFollowupModule,
    inquiry_followup_types: inquiryFollowUpTypeModule,
    inquiry_sources: inquirySourcesModule,
    inquiry_statuses: inquiryStatusModule,
    parents: parentModule,
    settings: settingModule,
    fee_types: feeTypeModule,
    fee_categories: feeCategoryModule,
    fee_discounts: feeDiscountModule,
    fee_structures: feeStructureModule,
    fees: feeModule,
    fee_transactions: feeTransactionModule,
    /*languages: languageModule,
     */
}
