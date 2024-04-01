import "@typespec/http";
import "@typespec/rest";
import "./responses.tsp";

using TypeSpec.Http;
using TypeSpec.Rest;

namespace Resource;

interface Crud<Item> {
    @get list(
        @query offset?: uint32,
        @query limit?: uint32,

        @query({
            name: "sort",
            format: "multi",
        })
        sort?: [string, "asc" | "desc"][],

        @query({
            name: "filters",
            format: "multi",
        })
        fitlers?: [string, string][],
    ): 
    | Models.Paginated<Item> 
    | Res.UnauthenticatedErorRes
    | Res.UnauthorizedErorRes
    | Res.ErrorRes;

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
