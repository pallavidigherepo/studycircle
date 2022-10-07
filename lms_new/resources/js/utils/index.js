import helper from "./helper";
//import faker from "./faker";
import lodash from "./lodash";
import colors from "./colors";

export default (app) => {
  app.use(helper);
  //app.use(faker);
  app.use(lodash);
  app.use(colors);
};
