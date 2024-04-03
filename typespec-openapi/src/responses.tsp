import "@typespec/http";
import "@typespec/rest";
import "./models.tsp";

using TypeSpec.Http;
using TypeSpec.Rest;

namespace Res;

alias CreatedRes<Item> = {
    @body body: {
        data: Item;
    };
    @statusCode statusCode: 201;
};

alias UnauthenticatedErorRes = {
    @body body: Models.UnauthenticatedError;
    @statusCode statusCode: 401;
};

alias UnauthorizedErorRes = {
    @body body: Models.UnauthorizedError;
    @statusCode statusCode: 403;
};

alias NotFoundRes = {
    @body body: Models.NotFoundError;
    @statusCode statusCode: 404;
};

alias ValidationErrorRes = {
    @body body: Models.ValidationError;
    @statusCode statusCode: 422;
};

alias ErrorRes = {
    @body body: Models.Error;
    @statusCode statusCode: 500;
};
