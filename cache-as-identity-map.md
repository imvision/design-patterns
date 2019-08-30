Identity map is used to keep track of objects that have been loaded from the database and are available in the memory. 
This avoids duplicate object loading and makes the system consistent when objects are changed and need to be saved to database.

## Using Cache as Identity Map

### Loading Objects Individually

    class AccountRepository

        function Account find(id)
            return _LazyLoad(id)

        function Account _LazyLoad(id)
            var key = "Account-" + id
            var object = _Cache.Get(key)
            if (object == null)
                object = QueryById(id)
                
            _Cache.set(key, object)
            return object            


Each account will be cached in memory for the set expiry time and it will be loaded from the database 
if not available in memory.

### Loading Bulk Objects

    class AccountRepository
        
        function Account[] findByIds(IDs)
            return _LazyLoadMulti(IDs)
        
        function _LazyLoadMulti(IDs)
            Objects = []
            ObjectsNotInCache = []
            
            foreach(var id in IDs) {
                var key = "Account-" + id
                var object = _Cache.Get(key)
                if (object == null)
                    ObjectsNotInCache.Add(id)
                else
                    Objects.Add(object)
            }
            
            if (ObjectsNotInCache.Count > 0)
                var OtherObjects = QueryByIds(ObjectsNotInCache)
                Objects.Concat(OtherObjects)
                
            return Objects;
            

This function will try to load available objects from memory and then load missing objects from the database.

### Updating objects in memory
