import "@typespec/http";
import "@typespec/rest";
import "./responses.tsp";

using TypeSpec.Http;
using TypeSpec.Rest;

namespace Resource;

interface Crud<Item> {
    //   @get list(): Models.Paginated<Item> | Res.ErrorRes | Res.ValidationErrorRes;
    @get list(): Item[] | Res.ErrorRes | Res.ValidationErrorRes;

    @post create(@body body: Item):
        | Res.CreatedRes<Item>
        | Res.ErrorRes
        | Res.ValidationErrorRes
        | Res.UnauthenticatedErorRes;

    @route("{id}")
    @get
    show(@path id: uuid):
        | Item
        | Res.UnauthenticatedErorRes
        | Res.NotFoundRes
        | Res.ErrorRes;

    @route("{id}")
    @patch
    edit(@path id: uuid, @body body: Item):
        | Item
        | Res.UnauthenticatedErorRes
        | Res.NotFoundRes
        | Res.ErrorRes;

    @route("{id}")
    @delete
    delete(@path id: uuid):
        | Models.Deleted
        | Res.UnauthenticatedErorRes
        | Res.NotFoundRes
        | Res.ErrorRes;
}
