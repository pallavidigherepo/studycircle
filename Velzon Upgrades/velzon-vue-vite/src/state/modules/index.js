import { createPinia, defineStore } from 'pinia';
import camelCase from 'lodash/camelCase';

const pinia = createPinia();
const modulesCache = {};
const piniaStoreData = { stores: {} };

// Dynamically import all store files except this index file or unit tests
const storeModules = import.meta.glob('./**/*.js', { eager: true });

for (const path in storeModules) {
  if (path.includes('index') || path.includes('.unit.')) continue;

  const storeDefinition = storeModules[path];
  if (modulesCache[path] === storeDefinition) continue;
  modulesCache[path] = storeDefinition;

  const storePath = path
    .replace(/^\.\//, '')     // Remove "./" prefix
    .replace(/\.\w+$/, '')    // Remove file extension
    .split(/\//)              // Split folders
    .map(camelCase);          // Convert all to camelCase

  const { stores } = getNamespace(piniaStoreData, storePath);
  const storeName = storePath.pop();
  stores[storeName] = defineStore(storeName, storeDefinition.default || storeDefinition);
}

// Recursively get the namespace of a Pinia store, even if nested.
function getNamespace(subtree, path) {
  if (path.length === 1) return subtree;

  const namespace = path.shift();
  subtree.stores = subtree.stores || {};
  subtree.stores[namespace] = {
    stores: {},
    ...subtree.stores?.[namespace],
  };
  return getNamespace(subtree.stores[namespace], path);
}

export default piniaStoreData.stores;
export { pinia };
