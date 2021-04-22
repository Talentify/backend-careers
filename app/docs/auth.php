<?php
/**
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     securityScheme="bearerAuth"
 * )
 */

/**
 * @OA\Post(
 *  path="/api/v1/auth/login",
 *  summary="Fazer Login e receber o Token",
 *  operationId="Token",
 *  tags={"Auth"},
 *  description="Endpoint para fazer login na aplicação e retornar o Token para ter acesso aos outros endpoints.",
 *  @OA\RequestBody(
 *      description="Data required",
 *      required=true,
 *      @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="email", type="string"),
 *              @OA\Property(property="password", type="string"),
 *          )
 *      )
 *  ),
 *  @OA\Response(
 *     response=200,
 *     description="Successful operation",
 *     @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="token", type="string")
 *          )
 *     )
 *  ),
 *  @OA\Response(
 *     response=401,
 *     description="{ 'error': 'Unauthorized' }",
 *  ),
 *   @OA\Response(
 *       response=422,
 *       description="Erro: O retorno será um array contendo a informação do(s) campo(s) obrigatório(s)",
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               @OA\Property(property="error", type="string"),
 *               @OA\Property(property="error1", description="O campo senha é obrigatório.")
 *           )
 *       )
 *   ),
 * )
 */

/**
 * @OA\Post(
 *  path="/api/v1/auth/logout",
 *  summary="Fazer Logout",
 *  operationId="token",
 *  tags={"Auth"},
 *  description="Endpoint para fazer logout da aplicação.
 *  O token deverá ser enviado na requisição.",
 *  security={{"bearerAuth":{}}},
 *  @OA\Response(
 *     response=200,
 *     description="Successfully logged out",
 *     @OA\MediaType(
 *          mediaType="application/json",
 *          @OA\Schema(
 *              @OA\Property(property="token", type="string")
 *          )
 *     )
 *  ),
 *  @OA\Response(
 *     response=401,
 *     description="{ 'error': 'Authorization Token not found.' }",
 *  ),
 * )
 */
